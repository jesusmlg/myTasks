<template>   
  <div class="container">
      <div class="row">
          <div class="col-md-12" style="margin-bottom:10px;">
            <button 
                class="btn" 
                v-bind:class="[(taskState == 'pending') ? 'btn-success' : 'btn-warning']" 
                v-on:click="showTaskState()">
                {{ taskStateText }}
            </button> 
          </div>
      </div>
      <div class="row"> 
          <div class="col-md-12">
              <form-component @newTask="newTask" :priorities="priorities" ></form-component>
          </div>
      </div>
      <p>
      </p>
      <div class="row justify-content-center">                  
          <div class="col-md-4 group-task" >
              <div class="list-group">
                <div class="list-group ">
                   <task-component v-if="task.priority=='high'"  v-for="(task,index) in tasks" :key="task.id" :priority="'high'" :task="task" @completedTask="completeTask()"></task-component>
                </div>
              </div>
          </div>
          
          <div class="col-md-4 group-task">
              <div class="list-group">
                <div class="list-group ">
                    <task-component v-if="task.priority=='medium'"  v-for="(task,index) in tasks" :key="task.id" :priority="'medium'" :task="task" @completedTask="completeTask()"></task-component>
                </div>
              </div>
          </div>

            
          <div class="col-md-4 group-task">
              <div class="list-group ">
                  <task-component v-if="task.priority=='low'" v-for="(task,index) in tasks" :key="task.id" :priority="'low'" :task="task" @completedTask="completeTask()"></task-component>
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
                category: 'WORK',
                taskStateText: 'Finished Tasks',
                taskState: 'pending'
            }
        },
        methods:{
          newTask(){
           this.loadTasks();
          },
          completeTask()
          {
            this.loadTasks();
          },
          loadTasks()
          {
            axios.get(miUrl+'/tasks',{params:{'category': this.category, 'state': this.taskState }}).then((response)=>{
                this.tasks = response.data.tasks;
                this.priorities = response.data.priorities;
            });
          },
          showTaskState(){

              if(this.taskState=='pending'){                  
                  this.taskStateText = "Pending Tasks";
                  this.taskState="done";
                  
              }
              else if(this.taskState=='done'){
                  this.taskStateText= "Finished Tasks";
                  this.taskState = "pending";
                  
              }
              
              
              this.loadTasks();
          }

        }
        
    }
</script>
