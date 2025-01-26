<template>
    <v-card elevation="0" style="width:80%">
        <v-card-title class="d-flex justify-content-end">
            <!-- Simplified @click event to directly set dialog -->
            <v-btn color="primary" @click="dialog.value = true">
                <v-icon>mdi-pencil</v-icon> Edit Profile
            </v-btn>
        </v-card-title>
        <v-card-text class="w-100">
            <NewsFeed :user_id="form.id" />
        </v-card-text>
        <v-dialog v-model="dialog.value" width="600px">
            <v-card style="height:50vh" class="login">
                <v-card-title>
                    Create Account
                </v-card-title>
                <v-card-text>
                    <!-- Added missing firstname and lastname bindings in form data -->
                    <v-text-field v-model="form.email" outlined label="Email" type="email" />
                    <v-text-field v-model="form.firstname" outlined label="First Name" />
                    <v-text-field v-model="form.lastname" outlined label="Last Name" />
                    <v-text-field v-model="form.password" outlined label="Password" type="password" />
                </v-card-text>
                <v-card-actions class="d-flex justify-content-between align-items-center"> 
                    <v-btn @click="submit" variant="tonal" color="success" class="w-100">
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script>
import NewsFeed from './Product.vue';
export default {
    components: {
        NewsFeed
    },
    data() {
        return {
            user: {},
            dialog: {
                action: '',
                value: false,
                selected: null
            },
            form: {
                email: '',
                firstname: '', // Added firstname
                lastname: '',  // Added lastname
                password: '',
                id: '' // Initialize id to use as user_id in NewsFeed
            }
        };
    },
    beforeMount() {
        const storedUser = JSON.parse(localStorage.getItem('user'));
        if (storedUser && storedUser.user) {
            this.form = storedUser.user;
        }
    },
    methods: {
        async submit() {
            try {
                const response = await this.$axios.post('/register', this.form);
                this.dialog.value = false;
                this.$swal.fire('Success', '', 'success');
            } catch (err) {
                console.error(err);
                this.$swal.fire('Error', '', 'error');
            }
        }
    }
}
</script>

<style scoped>
/* Add any custom styles here */
</style>
