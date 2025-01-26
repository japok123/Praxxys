<template>
    <v-card elevation="0" style="width:60%">
      <v-card-text>
        <!-- Create product -->
        <v-text-field readonly label="Create product" @click="openDialog('Create')"></v-text-field>
  
        <!-- Product dialog -->
        <v-dialog v-model="dialog.value" width="700px" persistent>
          <v-card>
            <v-card-title class="d-flex justify-content-between">
              <span>{{ dialog.action.toUpperCase() }} PRODUCT</span>
              <v-btn variant="text" color="red" @click="closeDialog">
                <v-icon>mdi-close-circle</v-icon>
              </v-btn>
            </v-card-title>
  
            <v-card-text>
              <!-- Name -->
              <v-text-field
                outlined
                label="Name"
                v-model="product.name"
                :readonly="dialog.action === 'View'"
              ></v-text-field>
  
              <!-- Category -->
              <v-select
                v-model="product.category"
                :items="categories"
                item-title="text"
                item-value="value"
                label="Category"
                outlined
                :readonly="dialog.action === 'View'"
              ></v-select>
  
              <!-- Description (HTML Editor - TinyMCE) -->
              <div>
                <editor
                  api-key="5lvex378rc80z1qwlqklzqtughfixcgvwqsbl3cusbd24wa0"
                  :init="editorOptions"
                  v-model="product.description"
                  :disabled="dialog.action == 'View'"
                />
              </div>
  
              <!-- Expiration Date -->
              <div class="text-center">
                <div>
             
                  <v-menu bottom>
                    <template v-slot:activator="{ props }">
                        <v-text-field
                            v-model="formattedExpirationDate"
                            label="Expiration Date"
                            @click="openDatePicker"
                            readonly
                           v-bind="props"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="product.expiration_date"
                        @input="menu = false"
                        v-bind="props"
                      ></v-date-picker>
                  </v-menu>
                </div>
              </div>
  
              <!-- Multiple Images -->
              <div>
                <v-file-input
                  label="Upload Images"
                  accept="image/*"
                  multiple
                  v-model="product.images"
                  :readonly="dialog.action === 'View'"
                  show-size
                ></v-file-input>
  
                <!-- Preview uploaded images -->
                <div class="d-flex flex-wrap">
                  <v-img
                    v-for="(image, index) in product.images"
                    :key="index"
                    :src="previewImage(image)"
                    max-height="100"
                    max-width="100"
                    class="mr-2 mb-2"
                  ></v-img>
                </div>
              </div>
            </v-card-text>
  
            <v-card-actions class="d-flex justify-content-end">
              <v-btn
                color="success"
                small
                variant="tonal"
                @click="saveProduct"
                v-if="dialog.action !== 'View'"
              >
                <v-icon>mdi-plus-box</v-icon> Save product
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
  
        <!-- Display products -->
        <v-card class="product my-3" v-for="(item, index) in products" :key="index">
          <v-card-title class="d-flex justify-content-between">
            {{ item.name.toUpperCase() }}
            <span>
              <v-btn color="orange" small variant="text" @click="openDialog('View', item)">
                <v-icon>mdi-eye</v-icon>
              </v-btn>
              <v-btn
                color="blue"
                small
                variant="text"
                @click="openDialog('Edit', item)"
              >
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
              <v-btn
                color="red"
                small
                variant="text"
                @click="deleteProduct(item)"
              >
                <v-icon>mdi-delete</v-icon>
              </v-btn>
            </span>
          </v-card-title>
  
          <v-card-subtitle>{{ categories.find(e => e.value == item.category).text}}</v-card-subtitle>
          <v-card-text>
            {{ stripHtml(shortenText(item.description, 200)) }}
            <div class="d-flex flex-wrap">
                <!-- {{ item.images }} -->
                <v-img
                    v-for="(image, index) in item.images"
                    :key="index"
                    :src="previewImage(image)"
                    max-height="100"
                    max-width="100"
                    class="mr-2 mb-2"
                ></v-img>
            </div>
            <p><strong>Expiration Date:</strong> {{ formatExpirationDate(item.expiration_date) }}</p>
          </v-card-text>
  
          <v-card-actions class="d-flex justify-content-end">
            <span>{{ formatDate(item.created_at) }}</span>
          </v-card-actions>
        </v-card>
      </v-card-text>
    </v-card>
  </template>
  
  <script>
  import moment from 'moment';
  import Editor from '@tinymce/tinymce-vue';
  import SharedFunctions from '@/sharedFunction/SharedFunctions.vue';
  
  export default {
    mixins:[SharedFunctions],
    components: {
      Editor,
    },
    data() {
      return {
        products: [],
        categories: [
          { text: 'Tech', value: 1 },
          { text: 'Lifestyle', value: 2 },
          { text: 'Education', value: 3 },
          { text: 'News', value: 4 },
        ],
        dialog: {
          action: '',
          value: false,
          selected: null,
        },
        menu: false,  
        location: 'top start', 
        product: {
          name: '',
          category: '',
          description: '',
          expiration_date: null,  // Date model
          images: [],
        },
        editorOptions: {
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code',
          ],
          toolbar:
            'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        },
      };
    },
    computed: {
          // Format the expiration date to YYYY-MM-DD
          formattedExpirationDate: {
              get() {
                  return this.product.expiration_date ? moment(this.product.expiration_date).format('YYYY-MM-DD') : '';
              },
              set(value) {
                  this.product.expiration_date = value ? moment(value, 'YYYY-MM-DD').toDate() : null;
              }
          }
      },
      mounted(){
        this.list()
      },
  
    methods: {
        openDialog(action, selected = null) {
            this.dialog.action = action;
            if (action === 'Create') {
                this.resetProduct();
            } else if (action === 'View' || action === 'Edit') {
                // Set the product fields and separate images into two categories
                this.product = { 
                    ...selected, 
                    images: selected.images || [],
                    oldImages: selected.images || [] // Store old images separately
                };
            }
            this.dialog.value = true;
        },
      closeDialog() {
        this.dialog.value = false;
        this.dialog.action = '';
        this.resetProduct();
      },
      resetProduct() {
        this.product = {
          name: '',
          category: '',
          description: '',
          expiration_date: null,  // Reset the date
          images: [],
        };
      },
      previewImage(file) {
        if (file instanceof File || file instanceof Blob) {
            console.log(1)
            return URL.createObjectURL(file);
        } else if (typeof file === 'string') {
            console.log(2)

            return file;
        } else if (file.image_path) {
            console.log(file.image_path)

            return `http://localhost:8000/storage/${file.image_path}`;
        } else {
            console.log(4)

            console.error('Invalid image format:', file);
            return '';
        }

    },
    formatExpirationDate(date) {
        return date ? moment(date).format('YYYY MMM DD') : 'No expiration date set';
    },
      
    async saveProduct() {
        const formData = new FormData();
        formData.append('name', this.product.name);
        formData.append('category', this.product.category);
        formData.append('description', this.product.description);
        formData.append('expiration_date', this.formattedExpirationDate);

        // Append existing image paths as 'old_images' to preserve them
        this.product.oldImages.forEach((image, index) => {
            formData.append(`old_images[${index}]`, image);
        });

        // Append new images
        this.product.images.forEach((image, index) => {
            if (typeof image !== 'string') {
                formData.append(`images[${index}]`, image);
            }
        });

        try {
            // Log FormData for debugging
            console.log("FormData content:");
            formData.forEach((value, key) => console.log(key, value));

            // Use Axios to send the request
            const url = this.dialog.action === 'Create' ? '/product' : `/product/${this.product.id}`;
            const response = await this.$axios.post(url, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data', // Set proper content type for FormData
                },
            });

            console.log(response.data); // Log the response for debugging
            this.list();
            this.closeDialog();
            this.$swal.fire('Success!', 'Product saved successfully.', 'success');
        } catch (err) {
            console.error(err);
            this.$swal.fire('Error', 'Failed to save product.', 'error');
        }
    },


      list(){
            this.$axios.post('products').then(response=>{
                this.products = response.data
                console.log(this.products)
            })
        },
    deleteProduct(selected){
        this.$swal.fire({
            title:'Are you sure you want to delete?',
            text:'',
            icon:'warning',
            showCancelButton:true
        }).then(action=>{
            if(action.isConfirmed){
                this.$axios.get('delete-product/' + selected.id ).then(response=>{
                    this.$swal.fire('Success!','','success')
                    this.list();
                }).catch(err=>{
                    this.$swal.fire('Error!','- an error occured','error')
                })
            }
        })
    },
    stripHtml(html) {
        return html.replace(/<\/?[^>]+(>|$)/g, ''); // Regex to remove HTML tags
    },
      
    },
  };
  </script>
  