<template>
    <app-layout>
        <template slot="header">
            Liste des formations
        </template>
        <div class="py-3" v-for="course in this.courseList" v-bind:key="course.id">
            <div class="mx-8 bg-white-200 rounded shadow p-4">
                <div class=" text-sm text-gray-500">Mis en ligne par {{ course.user.name }} - <span
                class="text-gray-500 text-sm">{{ course.participants }} participant<span v-if="parseInt(course.participants) > 1 ">s</span></span>
                </div>
                <div class="flex justify-between item-center">
                    <div class="text-4xl">{{ course.title }}</div>
                    <div class="text-sm text-gray-400">{{ course.episodes_count }} épisodes</div>
                </div>
                <div class=" text-sm text-gray-500">{{ course.description }}</div>
                <a :href="'course/' + course.id" class="bg-indigo-700 text-white px-3 py-2 text-sm mt-3 inline-block rounded hover:bg-indigo-500">Voir la formation</a>
            </div>
        </div>  
    </app-layout>
</template>

<script>

import AppLayout from './../../Layouts/AppLayout';

export default {
    components: {
        AppLayout,
    },

        props: ['courses'],

    data() {
        return {
            courseList: this.courses  
        }
    },

    mounted() {
        console.log(this.courseList);
    }
}
</script>