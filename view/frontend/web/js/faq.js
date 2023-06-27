define([
    'ko',
    'uiComponent'
], function (ko, Component) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'InfoBase_FAQ/faq/container',
            items: null
        },
        /**
         * @override
         */
        initialize: function() {
            this._super();
            this.hidrateItems(this.items);
        },
        /**
         * Convert items to observable and add flag for expandable
         * @param {Array} items 
         */
        hidrateItems: function(items) {
            items.map(item => {
                item.expanded = ko.observable(false);
            });

            this.items = ko.observableArray(this.items);
        },
        /**
         * Expand current item and collapse others
         * @param {Object} item 
         */
        expandItem: function(item) {
            let nStatus = !item.expanded();

            this.items().map(item => {
                item.expanded(false);
            });

            item.expanded(nStatus);            
        },
        /**
         * Get faq list
         * @returns {Array}
         */
        getItems: function() {
            return this.items();
        }
    });
});