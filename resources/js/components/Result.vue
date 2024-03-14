<template>
    <div class="image-gallery">
        <div v-for="(file, index) in files" :key="index" class="image-item">
            <img :src="'/storage/images/' + (currentImage === file.original ? file.original : file.preview)" @click="showOriginal(file.original)" class="image" :class="{ 'active': currentImage === file.original }" alt="Image">
            <p class="image-name">{{ file.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
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
            })
            .catch(error => {
                console.error(error);
            });
    },
    methods: {
        showOriginal(filename) {
            this.currentImage = this.currentImage === filename ? null : filename;
        }
    }
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
