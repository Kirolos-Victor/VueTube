<template>
    <!-- upload -->
    <div class="upload">
        <!-- container -->
        <div class="container" >
            <div class="upload-grids">
                <div class="upload-right" v-if="selected">
                    <div class="upload-file" >
                        <div class="services-icon" style="cursor:pointer;" aria-hidden="true" onclick="document.getElementById('file').click()">
                            <span class="glyphicon glyphicon-open" ></span>
                        </div>
                        <input type="file" id="file" value="Choose file.." @change="Upload()" ref="videos" multiple>
                    </div>
                    <div class="upload-info">
                        <h5>Select files to upload</h5>
                        <span>or</span>
                        <p>Drag and drop files</p>
                    </div>
                </div>
                <div class="upload-right" v-else>
                    <h1 class="text-center">Your videos</h1>
                    <template v-for="video in videos">
                        <div class="history-grids">
                            <div v-if="video.thumbnail" class="col-md-3">
                                <div class="resent-grid-img recommended-grid-img">
                                    <a :href="/videos/+video.id"><img :src="video.thumbnail" class="uploaded-img"></a>
                                </div>
                            </div>

                            <div v-else class="col-md-3 history-left">
                                <p>Thumbnail</p>
                            </div>
                            <div class="col-md-9 history-right">
                                <h5>{{ video.title|| video.name }}</h5>
                                <div class="progress ">
                                    <div v-if="!video.percentage" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" :style="{width: progress[video.name]+'%'}">
                                        {{progress[video.name] === 100 || !progress[video.name]?"Converted":progress[video.name] + "% progressing" }}
                                    </div>
                                    <div v-else class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" :style="{width: video.percentage +'%'}">
                                        {{ video.percentage === 100?"Video Uploading Completed.":video.percentage+"% Uploading"}}
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>

                    </template>

                </div>
        </div>
        <!-- //container -->

    </div>
    <!-- //upload -->
    </div>
</template>

<script>
export default {
    props:{
      channel:{
          required:true,
      }
    },
    data(){
        return{
            selected:true,
            videos:[
                name=100,
            ],
            progress:{},
            uploads:[],
            intervals:[]


        }
    },
    methods:{

        Upload(){
            this.selected=false
            this.videos = Array.from(this.$refs.videos.files);
          const uploaders = this.videos.map(video => {
                this.progress[video.name]=0;
               const form= new FormData();
                form.append('video',video);
                form.append('title',video.name);
                form.append('duration',video);


              return axios.post('/upload',form ,{
                    onUploadProgress:(event) => {
                        this.progress[video.name]=Math.ceil((event.loaded/event.total)*100);
                        this.$forceUpdate();
                    }
                }).then(({data})=>{
                    this.uploads=[
                        ...this.uploads,data
                    ]

                });

            });

          axios.all(uploaders).then(()=>{
              this.videos = this.uploads
              this.videos.forEach( video =>{
                  this.intervals[video.id]= setInterval(()=>{
                      axios.get('/videos/'+video.id).then(({data})=>{
                          if(data.percentage ===100){
                              clearInterval(this.intervals[video.id])
                          }
                          this.videos=this.videos.map(video=>{
                              if(video.id === data.id)
                              {
                                  return data;
                              }
                              return video;
                          })
                      })

                  },3000)
              })
          })
        }

    },
    name: "Upload"
}
</script>

<style scoped>
.container{
    margin-bottom: 200px;
}
.upload-right{
    padding-top: 20px;
}
.history-grids{
    margin-left: 10px;
}
.col-md-3{
    width: 200px!important;
}
.history-left{
    width: 200px !important;
}
.clck {
    position: absolute;

    z-index: 9;
    margin-right: 110px;
}
.time {
    position: absolute;
    right: 110px;
    display: block;
}
.show-time {
    top: 76% !important;
}
.small-time {
    z-index: 9;
    margin-left: 20px;
}
.place-img{
    width: 186px;
    height: 90px;
}
.uploaded-img{
    width: 186px;
    height: 90px;
}

</style>
