<template>
    <div>
        <!-- followers counter -->
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>subscribers:</b> <a class="float-right">{{subscribersCount}}</a>
            </li>

        </ul>
        <!--Button -->
        <button class="btn btn-danger btn-block" v-if="mainButtton" @click="toggleButton()"><b>unsubscribe</b></button>
        <button class="btn btn-success btn-block"  v-else @click="toggleButton()"><b>subscribe</b></button>

    </div>

</template>

<script>

export default {
    props:{
        channel:{
            required:true,
            type:Object,
            default: ()=>({})
        },
        subscribers:{
            required:true,
            type:Array,
            default:()=>[]
        }
    },
    data(){
        return{
            mainButtton:false,
            subscribersCount:this.subscribers.length,

        }
    },
    methods:{
        toggleSubscibe(){
          axios.post('/channel/'+this.channel.id+'/subscribe',{
              'user_id': __auth().id
        })
        },
        subscribeAuth(){
            if(!__auth()){
                window.location.href = "/login";

                return false;
            }
            else
            {
                return true;
            }

        },
        toggleButton(){
            if(this.subscribeAuth())
            {
                if(this.mainButtton === true){
                    Swal.fire({
                        title: 'Are you sure you want to unfollow, '+this.channel.name+'?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, do it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.mainButtton = false
                            this.toggleSubscibe();
                            Fire.$emit('reloadCounter');
                        }
                    })
                }
                else
                {
                    this.toggleSubscibe();
                    Fire.$emit('reloadCounter');
                    this.mainButtton = true
                }
            }

        },
        buttonState(){
            this.subscribers.filter( (subscriber)=>{
                if(subscriber.user_id === __auth().id){
                   this.mainButtton=true;
                }
                else
                {
                    this.mainButtton=false;
                }
            })

        },

    },
    created() {
        this.buttonState();
        Fire.$on('reloadCounter',()=>{
            axios.get('/channel/'+this.channel.id+'/count').then((data)=>{
                this.subscribersCount=data.data;
            })
        })
    },
    name: "subscribe-button"
}
</script>

<style scoped>

</style>
