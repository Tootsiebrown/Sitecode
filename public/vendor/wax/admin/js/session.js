    /**
     * Wax session timeout handler
     *
     * @author David Woodmansee
     */

    var waxSession;

    $(function() {
        if(window.waxSessionContent.loggedIn) {
            waxSession = new waxSession();
            waxSession.startTimer();
        }
    });

    function waxSession () {

        /**
         * self references the instantiated waxSession so that it remains
         * available within event-handler contexts
         */

        var self = this;

        this.timer = 0;
        this.sessionLife = (window.waxSessionContent.lifetime - 60) * 1000;
        this.thirtyTwoBitsMinusOne = 2147483647;


        this.startTimer = function () {
            life = this.sessionLife;
            if(arguments.length > 0) life = arguments[0];
            life = Math.min(life, this.thirtyTwoBitsMinusOne);
            this.timer = window.setTimeout(this.timeoutAlert, life);
        }


        this.clearTimer = function () {
            window.clearTimeout(this.timer);
        }


        this.keepalive = function () {
            $.get('/session-keep-alive', '', this.handleKeepalive, 'json');
        }

        /**
         * event handler for the keepalive ajax result.
         */

        this.handleKeepalive = function (data) {
            if(data.status) {
                self.startTimer();
            } else {
                self.logout();
            }
        }

        this.checklife = function () {
            $.get('/session-check-lifetime', '', this.handleChecklife, 'json');
        }

        this.handleChecklife = function (data) {
            console.log(data);
            if(!data.status) {
                self.logout();
            } else {
                if(data.life <= 60) {
                    if(window.waxSessionContent.autoRenew || confirm("Your session is about to expire.  Would you like to extend it?")) {
                        self.keepalive();
                    } else {
                        self.logout();
                    }
                } else {
                    self.clearTimer();
                    self.startTimer((data.life - 60) * 1000);
                }
            }
        }


        /**
         * event handler for the session timer
         */

        this.timeoutAlert = function () {
            self.checklife();
        }


        this.logout = function () {
            this.clearTimer();
            window.location = '/admin/logout';
        }
    }
