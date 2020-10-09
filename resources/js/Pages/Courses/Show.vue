<template>
    <app-layout>
        <template slot="header">
            {{ course.title }}
        </template>
        <div class="py-3">
            <div class="text-2xl">{{ course.episodes[0].title }}</div>
            <iframe class="w-full h-screen" :src="course.episodes[0].video_url" 
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; 
            picture-in-picture" allowfullscreen></iframe>
            <div class=" text-sm text-gray-500">{{ course.episodes[0].description }}</div>
        </div>  
    </app-layout>
</template>

<script>

import AppLayout from './../../Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },

    props: ['course'],

    data() {
        return {
            courseShow: this.course  
        }
    },

    mounted() {
/*         console.log(this.courseList);
 */    }
}
</script>