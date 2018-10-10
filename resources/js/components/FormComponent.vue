<template>
  <form>
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
        category:''
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
        
        axios.post('/tasks',params).then((response)=>{
          console.log(response);
          //let task = reponse;
        });

        //this.$emit('new', task);
        this.title = "";
        this.description ="";

        this.$emit('newTask');
      }
    }
  }
</script>