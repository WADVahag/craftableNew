import AppForm from '../app-components/Form/AppForm';

Vue.component('hotelroom-form', {
    mixins: [AppForm],
    props: [
        'availableNewcustomers'
    ],
    data: function() {
        return {
            form: {
                name:  '' ,
                newcustomers: ''
            }
        }
    }

});