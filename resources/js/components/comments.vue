<template>
    <div class="all-comments">
        <div class="all-comments-info">
            <a href="#">All Comments (8,657)</a>
            <div class="box">
                <form>
                    <textarea placeholder="Message" required=" " v-model="newComment"></textarea>
                    <input type="submit" value="SEND" @click.prevent="addComment">
                    <div class="clearfix"> </div>
                </form>
            </div>

        </div>
        <div class="media-grids">

            <div class="media" >
                <template v-for="comment in comments.data">
                    <h5>{{comment.user.name}}</h5>
                    <div class="media-left">
                        <a href="#">

                        </a>
                    </div>
                    <div class="media-body">
                        <p style="padding-top: 20px">{{comment.text}}</p>
                    </div>
                    <hr>
                </template>
                <div class="load-more">
                    <button class="btn btn-success" v-if="comments.next_page_url" @click.prevent="fetchComments">Load More</button>
                    <span v-else>No more comments :)</span>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "comments",
    props:{
      video:{
          required:true,
          type:Object,
          default: ()=>({})
      }
    },
    data(){
        return{
            comments:{
                data:[]
            },
            newComment:'',

        }
    },
    methods:{
        addComment(){
            if(this.newComment==='')
            {
                alert('please enter a text first');
            }
            if(!__auth())
            {
                window.location.href = "/login";
            }
          axios.post('/comments/'+this.video.id,{
              text:this.newComment
          }).then(({data})=>{

             this.comments = {
                 ...this.comments,
                 data: [
                     data,
                     ...this.comments.data
                 ]
             }
             this.newComment='';
          })
        },
        fetchComments(){
            const url=this.comments.next_page_url ? this.comments.next_page_url:'/comments/'+this.video.id;

            axios.get(url).then(({data})=>{
                this.comments= {
                    ...data,
                    data:[
                        ...this.comments.data,...data.data
                    ]
                };
            })
        }
    },
    created() {
        this.fetchComments();
    }
}
</script>

<style scoped>
.media h5{
    padding-top: 30px;
}
.load-more{
    margin-left: 300px;
    margin-top: 50px;
}
</style>
