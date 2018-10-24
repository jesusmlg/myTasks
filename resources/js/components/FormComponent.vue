<template>
  <form>
    
    <div v-if="Object.keys(errors).length > 0" class="alert alert-danger">
      <span v-for="(error) in errors">
        <li v-for="(e) in error">
          {{ e }}
        </li>
      </span>
    </div>
    <form action="" v-on:submit.prevent="newTask()">
      <div class="form-row">
        <div class="col-2">
          <input type="text" class="form-control" placeholder="Title" v-model="title"> 
        </div>
        <div class="col-6">
          <input type="text" class="form-control" placeholder="Description" v-model="description">
        </div>
        <div class="col-2">
          <select class="form-control" v-model="priority">
            <option v-for="(priority,index) in priorities" v-bind:value="priority" :key="index">
              {{ priority }}
            </option>
          </select>
        </div>
        <div class="col-2">
          <button class="btn btn-primary btn-block">Add Task</button> 
        </div>
      </div>
    </form>
  </form>
</template> 

<script>
  export default{
    props: ['priorities'],
    created() {
      this.$root.$on('send-category',(data) =>{
        this.category = data;
      })
    },
    data(){
      return {
        title: '',
        description: '',
        priority:'LOW',
        category:'WORK',
        errors: []
      }
    },
    methods:{
      newTask(){
        const params = {
          title: this.title,
          description: this.description,
          category: this.category,
          priority: this.priority
        };
        
        axios.post(miUrl+'/tasks',params).then((response)=>{
          this.title = "";
          this.description ="";
          this.$emit('newTask');          
        }).catch((error)=>{
          this.errors = error.response.data.errors;
          console.log(this.errors.length);
        });
        
      }
    }
  }
</script>