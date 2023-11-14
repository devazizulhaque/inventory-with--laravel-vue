<template>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}"><i class="bx bx-home-alt"></i></router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Category list</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Category List</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" v-model="search" type="text" placeholder="search">
                </form>
            </div>
            <hr/>
            <div class="col">
                <!-- Button trigger modal -->
                <router-link :to="{name: 'category-add'}" type="button" class="btn btn-primary"><i class="fadeIn animated bx bx-user-plus"></i>Add Category</router-link>
            </div>
          <div class="table-responsive mt-3">
            <table class="table align-middle">
              <thead class="table-secondary">
                <tr>
                 <th>#</th>
                 <th>Category Name</th>
                 <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(category, index) in filteredCategory" :key="category.id">
                 <td>{{ index + 1 }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                       <img :src="'/' + category.image" class="rounded-circle" width="44" height="44" alt="">
                       <div class="">
                         <p class="mb-0">{{ category.name }}</p>
                       </div>
                    </div>
                  </td>
                  <td>
                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                      <router-link :to="{ name: 'category-edit', params: { id: category.id } }" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                        <i class="bi bi-pencil-fill"></i>
                      </router-link>
                      <a @click="deleteCategory(category.id)" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</template>

<script>
import User from '../../Helpers/User';

export default {
    name: "CategoryView",
    components: {
    },
    data() {
      return {
        search: '',
        categories: [],
      }
    },
    methods: {
      getcategory() {
        axios.get('/api/category/')
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => {
          Toast.fire({
              icon: 'error',
              title: 'Supplier Not Found!!!',
          });
        })
      },

      deleteCategory(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this Category?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#277da1',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete('/api/category/' + id)
            .then((response) => {
              this.getcategory();
              Swal.fire(
                'Deleted!',
                'Category has been deleted.',
                'success'
              )
            })
            .catch((error) => {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
              })
            })
          }
        })
      },

    },
    computed: {
      filteredCategory() {
        return this.categories.filter((category) => {
          return category.name.toLowerCase().includes(this.search.toLowerCase());
        })
      }
    },
    created() {
      this.getcategory();
    },
}
</script>

<style>

</style>