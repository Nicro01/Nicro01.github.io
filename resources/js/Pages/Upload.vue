<template>
    <main class="container">
        <header style="padding: 1em">
            <h1 style="text-align: center">Nicro01</h1>
            <h3 class="subtitle" style="text-align: center">
                Templates / Components / Tips / Projects
            </h3>
        </header>
        <div>
            <Link href="/" style="display: flex; margin-bottom: 15px"
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    style="width: 1.5em"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"
                    />
                </svg>
            </Link>
            <form @submit.prevent="submit">
                <div>
                    <label for="folder">File Name</label>
                    <input type="text" name="folder" v-model="form.name" />
                    <input
                        type="file"
                        name="file"
                        v-on:change="handleFileUpload"
                    />
                </div>
                <div style="display: flex; align-items: center">
                    <button type="submit" style="margin-top: 20px">SEND</button>
                    <p
                        style="
                            font-size: 14px;
                            align-self: flex-end;
                            margin-left: 10px;
                        "
                    >
                        This file will be uploaded to
                        <span style="color: cadetblue">
                            / {{ this.current_folder.name }}</span
                        >
                    </p>
                </div>
            </form>

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
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

export default {
    props: {
        current_folder: Object,
    },
    data() {
        return {
            form: useForm({
                name: "",
                file: "",
            }),
        };
    },
    components: {
        Link,
    },
    methods: {
        handleFileUpload(e) {
            this.form.file = e.target.files[0];
        },

        submit() {
            let formData = new FormData();
            formData.append("name", this.form.name);
            formData.append("file", this.form.file);
            formData.append("_token", window.Laravel.csrfToken);

            axios
                .post("/upload/" + this.current_folder.id, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    console.log(response);
                    window.location.href = "/";
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
