import AppListing from '../app-components/Listing/AppListing';

Vue.component('book-listing', {
    mixins: [AppListing],
    
    data() {
        return {
            showWritersFilter: false,
            writersMultiselect: {},
    
            filters: {
                writers: [],
            },
        }
    },
    
    watch: {
        showWritersFilter: function (newVal, oldVal) {
            this.writersMultiselect = [];
        },
        writersMultiselect: function(newVal, oldVal) {
            this.filters.writers = newVal.map(function(object) { return object['key']; });
            this.filter('writers', this.filters.writers);
        }
    }
});