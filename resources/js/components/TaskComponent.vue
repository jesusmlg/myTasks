<template>
   <span  class="list-group-item list-group-item-action flex-column align-items-start task" :class="'div-'+this.priority" >
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 task-title">{{ task.title }}</h5>
            <small>{{ task.humanDate }}</small>
        </div>
        <p>
            <button v-on:click="onClickShowDescription()" v-if="task.description != null" class="btn btn-sm btn-info btn-outline-dark more-less">{{ moreLess }}</button>            
        </p>
        <p class="text-justify task-description">
            {{ description }}
        </p>        
        <p class="text-right">
            <button type="button" class="btn task-btn task-btn-done" v-if="task.state === 'pending' " v-on:click="onClickCompleteTask()" >Done</button>
            <button type="button" class="btn task-btn task-btn-delete" v-else-if="task.state === 'done' " v-on:click="onClickDeleteTask()" >Delete</button>
        </p>
    </span>
</template>

<script>
    export default {
        props: ['task','priority'],    
        

        mounted(){
            console.log('Component Task Mounted.');
        },
        data(){
            return {
                description : "",
                moreLess: "more",
            }
        },
        methods:{
            onClickCompleteTask(){
                axios.post(miUrl+'/tasks/'+this.task.id+"/complete").then((response) =>{
                    this.$emit('completedTask');
                });            
            },
            onClickDeleteTask(){
                axios.delete(miUrl+'/tasks/'+this.task.id).then((response) =>{
                    this.$emit('completedTask');
                });            
            },
            onClickShowDescription(){
                
                if(this.moreLess=="more")
                {
                    this.moreLess ="less";
                    this.description = this.task.description;
                }
                else
                {
                    this.moreLess ="more";
                    this.description = "";
                }
            }
        }
    }
</script>
