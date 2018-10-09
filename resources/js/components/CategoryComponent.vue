<template>
  <li>
    <select class="form-control" placeholder="Description" @change="onChange()" v-model="category" >
      <option v-for="(category, index) in categories" :key="index" >{{category}}</option>
    </select>
  </li>
</template>
<script>
export default {
 
  mounted(){
      axios.get('/categories').then((response) =>{
        this.categories = response.data;
      });
      console.log('Component mounted: category.');

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

