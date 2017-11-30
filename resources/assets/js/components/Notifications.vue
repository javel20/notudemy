<template>

    <li class="dropdown" v-if="notifications.length">
        <a href="#" class="dropdown-toogle" data-toggle="dropdown">
                        
                <span class="glyphicon glyphicon-bell"></span>
                <span class="badge" v-text="notifications.length"></span>
    
        </a>
        <ul class="dropdown-menu">
            <li v-for="notification in notifications">
                <a @click="markAsRead(notification)" :href="notification.data.link" v-text="notification.data.text"></a>
            </li>
        </ul>
    </li>

</template>

<script>
    export default {
        data(){
            return{
                notifications: []
            }
        },
        mounted() {
            axios.get('notificaciones').then(res => {
                this.notifications = res.data;
            })
        },
        methods: {
            markAsRead(notification){
                axios.patch('/notificaciones/' + notification.id);
            }
        }
    }
</script>
