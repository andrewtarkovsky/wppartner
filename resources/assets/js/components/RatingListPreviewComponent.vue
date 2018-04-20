<template>
  <div id="app">
    <div class="container">
      <div v-if="!isLoaded" class="information">
        Loading...
      </div>
      <div v-if="isLoaded">
        <div v-if="list && list.length" class="row ratinglist">
          <div class="ratinglist__header row col-xs-12 col-md-12 col-lg-12">
            <div class="col-xs-3 col-md-3 col-lg-3 ratinglist__header__item">
              Average Score
            </div>
            <div class="col-xs-3 col-md-3 col-lg-3 ratinglist__header__item">
              Votes
            </div>
            <div class="col-xs-3 col-md-3 col-lg-3 ratinglist__header__item">
              Post Title
            </div>
          </div>
          <div v-for="item in list" class="ratinglist__item row col-xs-12 col-md-12 col-lg-12">
            <div class="col-xs-3 col-md-3 col-lg-3 ratinglist__item__avg">
              {{item.avg}}
            </div>
            <div class="col-xs-3 col-md-3 col-lg-3 ratinglist__item__count">{{item.cnt}}</div>
            <div class="col-xs-6 col-md-6 col-lg-6 ratinglist__item__title">{{item.post_title}}</div>
          </div>
        </div>
        <div v-if="!list || !list.length" class="information">
          No ratings yet
        </div>
      </div>
    </div>
  </div>
</template>


<script>
  export default {
    data (){
      return {
        list : [],
        isLoaded: false
      }
    },
    methods : {
      getData() {
        self = this
        axios.get('/api/rating/preview/').then(response => {
          self.list = response.data
          self.isLoaded = true
        })
      },
    },
    mounted() {
      this.getData()
    }
  }

</script>
<!-- SASS styling -->
<style lang="scss">
  .information {
    padding: 2rem;
  }
  .ratinglist__item {
    cursor: pointer;
    overflow: hidden;
  }
  .ratinglist__item:hover {
    background: lightgray;
  }

  .ratinglist__item__avg {
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .ratinglist__item__count {
  }

  .ratinglist__item__title {
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .ratinglist__header {
    padding: 2rem 0;
  }
  .ratinglist__header__item {
    font-weight: 600;
    font-size: 1rem;
  }
</style>