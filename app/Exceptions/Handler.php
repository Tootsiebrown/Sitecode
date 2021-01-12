<?php

namespace App\Exceptions;

use App\Wax\Admin\Cms\Cms;
use Auth;
use Breadcrumbs;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\MessageBag;
use InvalidArgumentException;
use Wax\Db;
use Wax\Models\SystemNotice;
use Wax\System;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        $this->repairIfDatabaseError($e);

        if ($this->shouldReport($e)) {
            parent::report($e);
            if (!config('app.debug', false)) {
                $this->logSystemAlert($e);
            }
        }
    }

    protected function logSystemAlert($exception)
    {
        // test that we have a booted DB connection before we do this
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
        } catch (Exception $e) {
            return;
        }

        $message = $exception instanceof Exception ? strip_tags($exception->getMessage()) : $exception;

        if ($exception instanceof BadResponseException) {
            $message .= ' ' . $exception->getResponse()->getBody()->getContents();
        }

        $messageHash = md5($message);
        $messageTitle = 'The system has experienced an error and will attempt to alert a technical contact at Oohology. If this message persists please reach out to your account representative at Oohology so we can address the issue. Technical details: ' . $message;

        $existingNotice = SystemNotice::where('message_id', 'like', "{$messageHash}-%")
            ->where('archived', 0)
            ->take(1)
            ->first();

        // Email alerts will repeat for existing mesages, but are throttled
        if (!$existingNotice || $existingNotice->timestamp->lt(Carbon::now()->subDay())) {
            System::emailAlert($exception);

            if ($existingNotice) {
                $existingNotice->timestamp = Carbon::now();
                $existingNotice->save();
            }
        }

        // Dashboard notices will not repeat until previous messages are archived
        if (!$existingNotice) {
            $previousNotice = SystemNotice::where('message_id', 'like', "{$messageHash}-%")
                ->latest('timestamp')
                ->first();

            if ($previousNotice) {
                $splitId = explode('-', $previousNotice->message_id);
                $i = $splitId[1] + 1;
            } else {
                $i = 1;
            }

            SystemNotice::create([
                'title' => $exception instanceof Exception ? 'Exception' : 'Message',
                'message' => $messageTitle,
                'timestamp' => Carbon::now(),
                'message_id' => "{$messageHash}-{$i}",
                'archived' => 0,
            ]);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $exceptionName = (new \ReflectionClass($e))->getShortName();

        switch ($exceptionName) {
            case 'HttpException':
                return $this->renderHttpException($e);
                break;
            default:
                $method = 'render' . $exceptionName;
                if (method_exists($this, $method)) {
                    return $this->{$method}($request, $e);
                }
        }

        return parent::render($request, $e);
    }

    /**
     * Repair the DB if an error is found during a query.
     */
    protected function repairIfDatabaseError(Exception $e)
    {
        $isDbError = false;

        if ($e instanceof \PDOException && in_array($e->getCode(), ['42S22', '42S02'])) {
            $isDbError = true;
        }

        // Legacy Db errors
        if (Db::$dbh && in_array(Db::errno(), [1054, 1146])) {
            $isDbError = true;
        }

        if ($isDbError) {
            (new Cms())->checkAllTables();
        }
    }

    /**
     * Redirect to the login page if the token doesn't match.
     * Save the intent so for redirection after login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function renderTokenMismatchException($request, TokenMismatchException $exception)
    {
        Auth::logout();

        if ($request->expectsJson()) {
            return response()->json(
                new MessageBag(['_error' => ['Token Mismatch']]),
                400
            );
        }

        if (!app()->isRunningInBackend()) {
            try {
                return redirect()
                    ->guest(route('login'))
                    ->with('message', 'Your session expired. Please try again');
            } catch (InvalidArgumentException $e) {
                // 'login' route is not defined, fallback to admin redirect
            }
        }

        return redirect()
            ->guest(route('admin::login'))
            ->with('message', 'Your session expired. Please try again');
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(
                new MessageBag(['_error' => ['Unauthenticated.']]),
                401
            );
        }

        return redirect()->guest('login');
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param AuthorizationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function renderAuthorizationException($request, AuthorizationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(
                new MessageBag(['_error' => ['Unauthorized.']]),
                403
            );
        }

        $current = Url::current();
        $previous = Url::previous();
        $url = $current != $previous ? $previous : Url::to('/admin');
        return redirect($url)->with('message', 'Insufficient permission.');
    }

    protected function renderNotFoundHttpException(Request $request, Exception $e)
    {
        $page = app()->make(\Wax\Pages\Contracts\PagesRepositoryContract::class)->getByUrl('404');
        if (null != $page) {
            Breadcrumbs::set($page->breadcrumbs);
            $content = $page->content;
            $content->page = $page->toArray();
            return response()->view($content->getView(), $content->toArray(), 404);
        } else {
            return response()->view('site.pages.404', [], 404);
        }
    }

    protected function renderModelNotFoundException(Request $request, Exception $e)
    {
        if ($request->expectsJson()) {
            return response()->json(
                new MessageBag(['_error' => ['Bad Request']]),
                400
            );
        }

        return parent::render($request, $e);
    }
}
