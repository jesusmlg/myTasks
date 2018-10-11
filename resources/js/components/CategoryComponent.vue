<template>
  <li>
    
    <div class="col-auto">
      <label class="sr-only" for="inlineFormInputGroup">Username</label>
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">Category</div>
        </div>
        <select class="form-control" placeholder="Description" @change="onChange()" v-model="category" >
          <option v-for="(category, index) in categories" :key="index" >{{category}}</option>
        </select>
      </div>
    </div>
  </li>  
</template>
<script>
export default {
 
  mounted(){     
      axios.get(miUrl+'/categories').then((response) =>{
        this.categories = response.data;
      });     
  },
  data(){
    return{
      categories:[],
      priority: '',
      category: 'WORK'
    }
  },
  methods:{
    onChange()
    {
      console.log(this.priority);
      this.$root.$emit('send-category',this.category);
    }
  }
  
      
}
</script>

