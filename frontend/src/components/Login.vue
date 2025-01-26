<template>
    <v-card style="height:40vh" class="login">
        <v-card-title>
            Log in 
        </v-card-title>
        <v-card-text>
            <v-text-field v-model="form.email" outlined label="Email" type="email"></v-text-field>
            <v-text-field v-model="form.password" outlined label="Password" type="password"></v-text-field>
       
        </v-card-text>
        <v-card-actions class="d-flex justify-content-between align-items-center">
            <v-btn @click="submit" variant="tonal" color="primary w-100" :loading="loading">
                Log in
            </v-btn>
        </v-card-actions>
        <v-card-actions class="d-flex justify-content-between align-items-center">
            <v-checkbox v-model="form.remember_me" label="Remember me" hide-details></v-checkbox>
            <router-link to="/register">
                <v-btn color="primary" variant="text">
                    Create Account
                </v-btn>
            </router-link>
        </v-card-actions>
    </v-card>
</template>

<script>
import SharedFunctions from '@/sharedFunction/SharedFunctions.vue';

export default {
    mixins: [SharedFunctions],
    data() {
        return {
            form: {
                email: '',
                password: '',
                remember_me: false,
                loading:false
                
            },
            error: {
                value: false,
                text: ''
            }
        };
    },
    mounted(){
        
    },
    methods: {
        async submit() {
            this.loading = true;
            let checker = [
                this.verifyEmail(this.form.email),
                !!this.form.email,
                !!this.form.password
            ];
            
            if (checker.includes(false)) {
                this.$swal.fire('Error!', 'Please check your inputs','error');
                return false;
            }


            await this.$axios.post('/login', this.form).then(response => {
                if (response.data) {
                    const token = response.data.token;

                  
                    if (this.form.remember_me) {
                        localStorage.setItem("token", token);
                        localStorage.setItem("user", JSON.stringify(response.data));
                    } else {
                        sessionStorage.setItem("token", token); 
                        sessionStorage.setItem("user", JSON.stringify(response.data));
                    }
                    this.$router.push({ name: 'dashboard' });
                }
            }).catch(err => {
                console.log(err);
                this.$swal.fire('error', err.message, 'error','error');
            });

            this.loading = false;
        },

    }
};
</script>

<style lang="scss" scoped>
    .login {
        width: 500px !important;
    }
</style>
