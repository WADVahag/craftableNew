import AppForm from '../app-components/Form/AppForm';

Vue.component('book-form', {
    mixins: [AppForm],
  
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                writer_id:  '' ,
                writer:  '' ,
            },  props: [
                'writers'
            ],
        }
    }

});