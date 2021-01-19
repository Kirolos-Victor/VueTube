<template>
    <div class="top-search" >
        <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search..." style="border-radius:10px 10px 0 0" @input="titleSearch()" v-model="inputTitle">
            <input type="submit" value=" ">
            <div v-if="titles" class="list-group" aria-expanded="false" style="margin-bottom: -300px">
                <template v-for="title in titles">
                    <a :href="'/?search='+title" class="list-group-item list-group-item-action" style="border-radius: 0"
                    >{{ title }}</a>
                </template>


            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            inputTitle:'',
            titles:[],

        }
    },
    methods:{
  titleSearch(){
      axios.get('/titles?search='+this.inputTitle
      ).then(({data})=>{
          this.titles=data;
      })
  },
},
    name: "SearchForm"
}
</script>

<style scoped>

</style>
