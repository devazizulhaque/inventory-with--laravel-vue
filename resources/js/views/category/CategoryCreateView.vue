<template>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}"><i class="bx bx-home-alt"></i></router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Category Create</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="p-4 border rounded">
                <form @submit.prevent="category" enctype="multipart/form-data">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Category Add</h5>
                    </div>
                    <hr/>
                    <div class="row mb-3">
                        <label for="inputEnterCategoryName" class="col-sm-3 col-form-label">Enter Category Name</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            <input type="text" class="form-control" id="inputEnterCategoryName" placeholder="Enter Category Name" v-model="form.name">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputPhoto" class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-5">
                            <small class="text-danger" v-if="errors.newPhoto">{{ errors.newPhoto[0] }}</small>
                            <input type="file" class="form-control" id="inputPhoto" placeholder="Choose Photo" @change="onFileSelected">
                        </div>
                        <div class="col-sm-4">
                            <img :src="form.newPhoto" alt="" width="100">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</template>

<script>
export default {
    name: "CategoryCreateView",
    data() {
        return {
            form: {
                name: '',
                photo: '',
                newPhoto: '',
            },
            errors: {},
        }
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: 'error',
                    title: 'File size should be less than 1 MB.',
                })
            }
            else{
                this.form.newPhoto = URL.createObjectURL(file);
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form.newPhoto = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        
        category() {
            axios.post('/api/category', this.form)
                .then(res => {
                    this.$router.push({name: 'category'});
                    Toast.fire({
                        icon: 'success',
                        title: 'Category created successfully...',
                    });
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
    },
    mounted() {
        //
    }
}
</script>

<style>

</style>