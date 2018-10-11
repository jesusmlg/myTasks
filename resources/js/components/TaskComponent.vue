<template>
   <a href="#" class="list-group-item list-group-item-action flex-column align-items-start" :class="'div-'+this.priority" >
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1 task-title">{{ task.title }}</h5>
            <small>{{ task.humanDate }}</small>
        </div>
        <p class="mb-1 text-justify task-description">{{ task.description }}</p>
        <p class="text-right">
            <button type="button" class="btn task-btn" v-on:click="onClickCompleteTask()">Done</button>
        </p>
    </a>
</template>

<script>
    export default {
        props: ['task','priority'],    
        
        mounted(){
            console.log('Component Task Mounted.');
        },
        data(){
            return {
                
            }
        },
        methods:{
            onClickCompleteTask(){
                axios.post(miUrl+'/tasks/'+this.task.id+"/complete").then((response) =>{
                    this.$emit('completedTask');
                });            
            }
        }
    }
</script>
