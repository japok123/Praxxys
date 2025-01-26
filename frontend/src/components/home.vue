<template>
   <v-card>
        <v-layout>
            <v-navigation-drawer floating permanent class="bg-secondary">
                <v-list density="compact" nav >
                <!-- navigation is dynamic depending on the value of "navigation variable" -->
                    <v-list-item 
                        v-for="(item,key) in navigations" :key="key"
                        :prepend-icon="item.prependIcon"
                        :title="item.title"
                        :value="item.value"
                        @click="action(item.value)"
                    ></v-list-item>

                </v-list>
            </v-navigation-drawer>
            <v-main style="height: 100vh;overflow:scroll" class="d-flex justify-content-center align-items-start p-5">   
                <router-view></router-view>
            </v-main>
        </v-layout>
  </v-card>
</template>

<script>

import SharedFunctions from '@/sharedFunction/SharedFunctions.vue';
export default {
     mixins:[SharedFunctions],
    data:()=>{
        return{
            navigations:[
                { prependIcon:'mdi-view-dashboard',title:'dashboard', value:'dashboard',},
                { prependIcon:'mdi-view-dashboard',title:'Product', value:'procduct',},
                { prependIcon:'mdi-logout',title:'Log out', value:'Login'},
            ],
            user:{}
        }
    },
    beforeMount(){
         this.user = JSON.parse(localStorage.getItem('user')).user
    },
    methods:{
        async action(item){
            if(item == 'Login'){
                this.logout()
            }else{
                this.$router.push({ name: item });
            }
        },
        async logout() {
            await this.$axios.get('/logout')
            .then(response => {

                localStorage.removeItem("token");
                localStorage.removeItem("user");
                sessionStorage.removeItem("token");
                sessionStorage.removeItem("user");
                this.$router.push({ name: 'Login' });
            })
            .catch(err => {
                console.error('Error logging out:', err);
            });
        }

    }
}
</script>

<style lang="scss" scoped>
    .background{
        background: linear-gradient(to bottom, #feb47b, #ff7e5f);

    }
</style>