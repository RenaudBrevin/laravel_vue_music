<template>
  <div class="flex items-center flex-row p-4 bg-white shadow-md rounded-lg transition duration-300 hover:shadow-xl cursor-pointer">
    <img :src="'/storage/' + track.image" alt="track_cover" class="mr-4 rounded-lg w-20 h-20 object-cover">
    <div @click="playAudio(track)" class="flex flex-col justify-center items-start">
      <h3 class="text-2xl font-bold text-indigo-600 hover:underline mb-1">{{ track.title }}</h3>
      <h4 class="text-gray-600 mb-2">{{ track.artist }}</h4>
      <div
      v-if="$page.props.isAdmin"
       class="flex gap-4">
        <Link :href="route('tracks.edit', {track: track})" class="inline-block px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition duration-300">Modifier</Link>
        <Link :href="route('tracks.destroy', {track: track})" class="inline-block px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 transition duration-300" method="delete" as="button">Supprimer</Link>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    Link,
  },
  props: {
    track: Object,
  },
};
</script>
