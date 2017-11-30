<template>

    <li :class="dropdownClasses">
        <a @click="isDropdownOpen = ! isDropdownOpen" :href="linkToNotifications" class="dropdown-toogle">
                        
                <span class="glyphicon glyphicon-bell"></span>
                <span v-if="notifications.length" class="badge" v-text="notifications.length"></span>
    
        </a>
        <ul class="dropdown-menu" v-if="notifications.length">
            <li v-for="notification in notifications">
                <a @click="markAsRead(notification)" :href="notification.data.link" v-text="notification.data.text"></a>
            </li>
            <li class="divider"></li>
            <li><a @click="markAllAsRead" href="#">Marcar todo como leído</a></li>
        </ul>
    </li>

</template>

<script>
    export default {
        data(){
            return{
                notifications: [],
                isDropdownOpen: false
            }
        },
        mounted() {
            axios.get('notificaciones').then(res => {
                this.notifications = res.data;
            })
        },
        methods: {
            markAsRead(notification){
                axios.patch('/notificaciones/' + notification.id)
                    .then(res=>{
                        this.notifications = res.data;
                    });
            },
            markAllAsRead(){
                this.notifications.forEach(notification => {
                    this.markAsRead(notification);
                });
            },
        },
        computed: {
            dropdownClasses(){
                return ['dropdown', this.isDropdownOpen ? 'open' : ''];
            },
            linkToNotifications(){
                return this.notifications.length ? "#" : "/notificaciones";
            }
        }
    }
</script>
