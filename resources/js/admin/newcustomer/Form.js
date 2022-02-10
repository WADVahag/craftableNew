import AppForm from '../app-components/Form/AppForm';

Vue.component('newcustomer-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});