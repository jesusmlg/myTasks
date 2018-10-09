<template>
  <div class="container">
      <div class="row"> 
          <div class="col-md-12">
              <form-component @new="addTask" :priorities="priorities" ></form-component>
          </div>
      </div>
      <p>
      </p>
      <div class="row justify-content-center">                  
          <div class="col-md-4">
              <div class="list-group ">
                  <task-component v-if="task.priority=='low'" v-for="(task,index) in tasks" :key="task.id" :priority="'low'" :task="task" @complete="completeTask(index)"></task-component>
              </div>
          </div>
          
          <div class="col-md-4">
              <div class="list-group">
                <div class="list-group ">
                    <task-component v-if="task.priority=='medium'"  v-for="(task,index) in tasks" :key="task.id" :priority="'medium'" :task="task" @complete="completeTask(index)"></task-component>
                </div>
              </div>
          </div>

          <div class="col-md-4">
              <div class="list-group">
                <div class="list-group ">
                   <task-component v-if="task.priority=='high'"  v-for="(task,index) in tasks" :key="task.id" :priority="'high'" :task="task" @complete="completeTask(index)"></task-component>
                </div>
              </div>
          </div>
      </div>    
  </div>
</template>
<script>
    export default {
        //props: ['category'],

        mounted() {
            this.$root.$on('send-category',(data) =>{
                this.category = data;
                this.loadTasks();
            })
            
            this.loadTasks();
        },
 
        data(){
            return{
                tasks: [],
                priorities: [],
                category: 'WORK'
            }
        },
        methods:{
          addTask(task){
           
          },
          completeTask(index)
          {
            
          },
          loadTasks()
          {
                axios.get('/tasks',{params:{'category': this.category}}).then((response)=>{
                this.tasks = response.data.tasks;
                this.priorities = response.data.priorities;
            });
          }          

        }
        
    }
</script>
