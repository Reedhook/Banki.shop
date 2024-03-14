<script>
export default {
    name: "Result",
    data() {
        return {
            imagesData: null,
        };
    },
    methods: {
        getImagesData() {
            axios.get('/api/images/')
                .then(res => {
                    this.imagesData = res.data.body.images;
                     // Вызываем метод для получения содержимого изображений после получения данных о файлах
                })
                .catch(error => {
                    console.error(error);
                });
        },
        getImages() {
            axios.get('/api/images/getImages/')
                .then(res => {
                    this.imagesData.forEach(image => {
                        const imageData = res.data.find(data => {
                            const imageNameWithoutPrefix = image.name.replace('preview_', '');
                            return data.name === imageNameWithoutPrefix;
                        });
                        if (imageData) {
                            image.content = imageData.content;
                            image.type = imageData.type;
                        }
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
    created() {
        this.getImagesData();
        this.getImages();
    },
};
</script>

<template>
    <div>
        <div v-if="imagesData">
            <div v-for="(image, index) in imagesData" :key="index">
                <img :src="'data:' + image.type + ';base64,' + image.content" alt="Image">
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Стилизуйте изображения по вашему усмотрению */
img {
    max-width: 100px; /* Установите максимальную ширину изображения */
    margin: 5px; /* Добавьте отступы между изображениями */
}
</style>
