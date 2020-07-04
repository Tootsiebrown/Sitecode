<?php

return [

    /**
     * What dashboard panels are enabled on this site? Keys should
     * be shorthand (to be passed through the URL for actions)
     * and value should be fully namespaced classname.
     */
    'panels' => [
        'analyticsLineChart' => Wax\Admin\Dashboard\Panels\AnalyticsLineChart::class,
        'analyticsPieChart' => Wax\Admin\Dashboard\Panels\AnalyticsPieChart::class,
        'pushNotices' => Wax\Admin\Dashboard\Panels\PushNotices::class,
        'systemNotices' => Wax\Admin\Dashboard\Panels\SystemNotices::class,
    ],

];
