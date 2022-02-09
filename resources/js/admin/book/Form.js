import AppForm from '../app-components/Form/AppForm';

Vue.component('book-form', {
    mixins: [AppForm],
    props: [
        'writers'
    ],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                writer_id:  '' ,
                writer:  '' ,
            }
        }
    }

});