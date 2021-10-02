<template>
  <div class="w-full flex-none flex items-center">
    <!-- full star -->
    <svg v-for="star in stars.full" class="h-4 w-4 text-yellow-400 mr-1" fill="currentColor"
         stroke="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path
          d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
    </svg>
    <!-- half star -->
    <svg v-for="star in stars.half" class="w-4 h-4 text-yellow-400 mr-1" fill="none" stroke="currentColor"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
      <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></path>
    </svg>
    <!-- emtpy Star -->
    <svg v-for="star in stars.empty" class="w-4 h-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
      <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2"></path>
    </svg>
    <span class="text-gray-400 whitespace-nowrap mr-3">{{ getRating }}</span>
  </div>
</template>

<script>
export default {
  name: "StarRating",
  props: {
    data: {
      type: Number,
      default: 0
    }
  },
  data() {
    return {
      rating: this.data || 0
    }
  },
  computed: {
    stars() {
      let stars = {};
      let temp = this.rating.toPrecision(2);
      stars.full = Math.floor(temp);
      stars.half = Math.round(temp) - stars.full;
      stars.empty = 5 - stars.full - stars.half;
      return stars;
    },
    getRating() {
      return this.rating.toPrecision(2);
    }
  }
}
</script>

<style scoped>

</style>
