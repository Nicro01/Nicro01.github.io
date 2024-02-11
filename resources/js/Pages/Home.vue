<template>
    <main class="container">
        <header style="padding: 1em">
            <h1 style="text-align: center">Nicro01</h1>
            <h3 class="subtitle" style="text-align: center">
                Templates / Components / Tips / Projects
            </h3>
        </header>
        <div>
            <progress
                class="rooms-progress"
                max="100"
                value="29"
                style="opacity: 10"
            >
                29%
            </progress>
            <div
                style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                "
            >
                <p class="breadcrumbs" style="user-select: none;">
                    <p  ><span @click="parent_id = parent_id > 1 ? parent_id - 1 : parent_id" style="cursor: pointer;display: inline;">/ Home</span> <b v-if="parent_id != 1" >{{ current_path }}</b></p>
                </p>
                <Link :href="route('upload', parent_id)"
                    ><button style="margin-bottom: 0 !important; display: flex; padding: 2px 10px;"  >
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.3em; margin-right: 5px;">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
</svg>
                        <p style="margin: 5px 0;">Upload</p>
                       
</button></Link
                >
            </div>

            <div>
                <hr class="building-hr" />
                <table>
                    <tbody>
                        <tr v-for="folder in folders">
                            <td style="max-width: 1em; margin-right: 10px">
                                📂
                            </td>
                            <td>
                                <strong style="text-align: start"
                                    ><a
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        style="cursor: pointer"
                                        @click="parent_id = folder.id"
                                        >{{ folder.name }}
                                    </a></strong
                                >
                            </td>
                            <td
                                class="text-td"
                                style="text-align: end; font-size: small"
                            >
                                {{ formatDate(folder.updated_at) }}
                            </td>
                        </tr>
                        <tr v-for="file in files">
                            <td style=" margin-right: 10px" v-if="file.extension == 'py'">
                                <svg style="max-width: 0.7em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#469df4" d="M439.8 200.5c-7.7-30.9-22.3-54.2-53.4-54.2h-40.1v47.4c0 36.8-31.2 67.8-66.8 67.8H172.7c-29.2 0-53.4 25-53.4 54.3v101.8c0 29 25.2 46 53.4 54.3 33.8 9.9 66.3 11.7 106.8 0 26.9-7.8 53.4-23.5 53.4-54.3v-40.7H226.2v-13.6h160.2c31.1 0 42.6-21.7 53.4-54.2 11.2-33.5 10.7-65.7 0-108.6zM286.2 404c11.1 0 20.1 9.1 20.1 20.3 0 11.3-9 20.4-20.1 20.4-11 0-20.1-9.2-20.1-20.4 .1-11.3 9.1-20.3 20.1-20.3zM167.8 248.1h106.8c29.7 0 53.4-24.5 53.4-54.3V91.9c0-29-24.4-50.7-53.4-55.6-35.8-5.9-74.7-5.6-106.8 .1-45.2 8-53.4 24.7-53.4 55.6v40.7h106.9v13.6h-147c-31.1 0-58.3 18.7-66.8 54.2-9.8 40.7-10.2 66.1 0 108.6 7.6 31.6 25.7 54.2 56.8 54.2H101v-48.8c0-35.3 30.5-66.4 66.8-66.4zm-6.7-142.6c-11.1 0-20.1-9.1-20.1-20.3 .1-11.3 9-20.4 20.1-20.4 11 0 20.1 9.2 20.1 20.4s-9 20.3-20.1 20.3z"/></svg>
                            </td>
                            <td style=" margin-right: 10px" v-if="file.extension == 'js'">
<svg style="max-width: 0.7em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="#FFD43B" d="M0 32v448h448V32H0zm243.8 349.4c0 43.6-25.6 63.5-62.9 63.5-33.7 0-53.2-17.4-63.2-38.5l34.3-20.7c6.6 11.7 12.6 21.6 27.1 21.6 13.8 0 22.6-5.4 22.6-26.5V237.7h42.1v143.7zm99.6 63.5c-39.1 0-64.4-18.6-76.7-43l34.3-19.8c9 14.7 20.8 25.6 41.5 25.6 17.4 0 28.6-8.7 28.6-20.8 0-14.4-11.4-19.5-30.7-28l-10.5-4.5c-30.4-12.9-50.5-29.2-50.5-63.5 0-31.6 24.1-55.6 61.6-55.6 26.8 0 46 9.3 59.8 33.7L368 290c-7.2-12.9-15-18-27.1-18-12.3 0-20.1 7.8-20.1 18 0 12.6 7.8 17.7 25.9 25.6l10.5 4.5c35.8 15.3 55.9 31 55.9 66.2 0 37.8-29.8 58.6-69.7 58.6z"/></svg>                            
</td>
<td style=" margin-right: 10px" v-if="file.extension == 'html'">
<svg style="max-width: 0.7em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#e85711" d="M0 32l34.9 395.8L191.5 480l157.6-52.2L384 32H0zm308.2 127.9H124.4l4.1 49.4h175.6l-13.6 148.4-97.9 27v.3h-1.1l-98.7-27.3-6-75.8h47.7L138 320l53.5 14.5 53.7-14.5 6-62.2H84.3L71.5 112.2h241.1l-4.4 47.7z"/></svg> </td>
                          
                            <td>
                                
                                <strong style="text-align: start"
                                    ><Link
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        :href="route('file.show', file.id)"
                                        >{{ file.name }}
                                    </Link></strong
                                >
                            </td>
                            <td
                                class="text-td"
                                style="text-align: end; font-size: small"
                            >
                                {{ formatDate(file.updated_at) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <footer style="margin-top: 2em">
                <hr />
                <p>
                    made by
                    <a href="https://webgenie.com.br">Webgenie</a>
                </p>
            </footer>
        </div>
    </main>
</template>
<script>
import axios from "axios";
import { Link } from "@inertiajs/vue3";

export default {
    data() {
        return {
            folders: [],
            files: [],
            parent_id: 1,
            current_path: "/",
        };
    },
    components: {
        Link,
    },
    watch: {
        parent_id() {
            axios.get(`/folders/` + this.parent_id).then((response) => {
                this.folders = response.data.folders;
                this.current_path = "/ " + response.data.currentFolder.name;
            });
            axios.get(`/files/` + this.parent_id).then((response) => {
                this.files = response.data;
            });
        },
    },
    mounted() {
        axios.get(`/folders/` + this.parent_id).then((response) => {
            this.folders = response.data.folders;
        });
        axios.get(`/files/` + this.parent_id).then((response) => {
            this.files = response.data;
        });
    },
    methods: {
        formatDate(date) {
            const parsedDate = Date.parse(date);
            if (isNaN(parsedDate)) {
                return "Data inválida";
            }
            return new Date(parsedDate).toLocaleString();
        },
    },
};
</script>
