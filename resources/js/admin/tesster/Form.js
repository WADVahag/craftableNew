import AppForm from '../app-components/Form/AppForm';

Vue.component('tesster-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});