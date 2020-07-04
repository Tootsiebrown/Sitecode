const DEFAULT = {
    name: 'Unnamed Module',
    el: 'body',
};

export default {

    exists: false,

    construct(moduleDefault, args) {
        if (typeof args === 'string') {
            args = {
                el: args,
            };
        }

        let settings = Object.assign({}, DEFAULT, moduleDefault, args);

        if ($(settings.el).length) {
            this.exists = true;
        }

        return settings;
    },

    start(args) {
        if (this.exists) {
            try {
                this.action(args);
            } catch (err) {
                console.log(`There was a problem with ${DEFAULT.name}. :(`);
                console.log(err);
            }
        }
    },

    action() {
        throw 'The \'action\' method must be defined in a concrete module';
    },
};