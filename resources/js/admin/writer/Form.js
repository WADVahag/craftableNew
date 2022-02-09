import AppForm from '../app-components/Form/AppForm';

Vue.component('writer-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});