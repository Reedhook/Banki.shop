<template>
    <div>
        <div class="btn" @click="sortingByName">
            Сортировать по имени
        </div>
        <div class="btn" @click="sortingByDate">
            Сортировать по дате
        </div>
        <div v-for="(file, index) in files" :key="index" class="image-item">
            <img :src="'/storage/images/' + (currentImage === file.original ? file.original : file.preview)" @click="showOriginal(file.original)" class="image" :class="{ 'active': currentImage === file.original }" alt="Image">
            <p class="image-name">{{ file.name }}</p>
            <div class="btn" @click.prevent="this.downloadImages(file)">Download</div>
        </div>
    </div>
</template>
<script>

import JSZip from "jszip";
import { saveAs } from "file-saver";

export default {
    name: 'Result',
    data() {
        return {
            files: [],
            currentImage: null
        }
    },
    created() {
        axios.get('/api/getImages')
            .then(response => {
                this.files = response.data.files;
                console.log(response);
            })
            .catch(error => {
                console.error(error);
            });
    },
    methods: {
        sortingByName() {
            this.files.sort((a, b) => a.name.localeCompare(b.name));
        },
        sortingByDate() {
            this.files.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
        },
        showOriginal(filename) {
            this.currentImage = this.currentImage === filename ? null : filename;
        },
        downloadImages(file) {
            const zip = new JSZip();
            const folder = zip.folder('images');
            const imageUrl = '/storage/images/' + file.original;
            const filename = file.name;

            fetch(imageUrl)
                .then(response => response.blob())
                .then(blob => {
                    folder.file(filename, blob);

                    zip.generateAsync({ type: 'blob' })
                        .then(content => {
                            saveAs(content, filename + '.zip');
                        });
                })
                .catch(error => {
                    console.error('Ошибка при загрузке или скачивании изображения:', error);
                });
        }
    },

}
</script>

<style scoped>
.image-gallery {
    display: flex;
    flex-wrap: wrap;
}

.image-item {
    margin: 10px;
    text-align: center;
}

.image {
    max-width: 100px;
    cursor: pointer;
    transition: transform 0.3s;
}

.image.active {
    transform: scale(1.1);
}

.image-name {
    margin-top: 5px;
}
</style>
