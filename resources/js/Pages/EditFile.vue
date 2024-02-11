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
                <prism-editor
                    class="my-editor"
                    v-model="content"
                    style="margin-bottom: 25px"
                    :highlight="highlighter"
                    line-numbers
                ></prism-editor>
                <div style="display: flex; justify-content: space-between">
                    <button type="submit">Save</button>
                    <button
                        type="button"
                        style="
                            color: rgb(238, 90, 90);
                            border-color: rgb(238, 90, 90);
                        "
                        @click="deleteFile"
                    >
                        Delete
                    </button>
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
import { Link } from "@inertiajs/vue3";

import { PrismEditor } from "vue-prism-editor";
import "vue-prism-editor/dist/prismeditor.min.css";
import { highlight, languages } from "prismjs";
import "prismjs/components/prism-javascript";
import "prismjs/components/prism-clike";
import "prismjs/themes/prism-tomorrow.css";

export default {
    props: {
        file: Object,
        fileContent: String,
    },
    components: {
        Link,
        PrismEditor,
    },
    data() {
        return {
            content: "",
        };
    },
    mounted() {
        this.content = this.fileContent;
    },
    methods: {
        async submit() {
            await axios
                .post("/files/edit/" + this.file.id, {
                    content: this.content,
                })
                .then((response) => {
                    console.log(response);
                    window.location.href = "/";
                });
        },

        deleteFile() {
            axios.delete("/file/" + this.file.id).then((response) => {
                console.log(response);
                window.location.href = "/";
            });
        },
        initEditor() {
            editor.session.setMode(`ace/mode/${this.file.extension}`);
        },
        highlighter(code) {
            return highlight(code, languages.js);
        },
    },
};
</script>
<style scoped>
/* required class */
.my-editor {
    /* we dont use `language-` classes anymore so thats why we need to add background and text color manually */
    background: #2d2d2d;
    color: #ccc;

    /* you must provide font-family font-size line-height. Example: */
    font-family: Fira code, Fira Mono, Consolas, Menlo, Courier, monospace;
    font-size: 14px;
    line-height: 1.5;
    padding: 5px;
}

/* optional class for removing the outline */
.prism-editor__textarea:focus {
    outline: none;
}
</style>
