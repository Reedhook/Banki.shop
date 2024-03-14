<script>
export default {
    name: "Home",
    methods: {
        selectImages(e) {
            const file = e.target.files[0];
            const isDuplicate = this.images.some(image => image.name === file.name);
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']; // Разрешенные типы изображений
            if (this.images.length >= 5) {
                alert('Максимум 5 файлов');
            } else if (!isDuplicate && allowedTypes.includes(file.type)) {
                this.images.push(file);
            } else if(isDuplicate) {
                alert('Пожалуйста, выберите только изображения (jpeg, png, gif, jpg)');
            }

        },
        uploadImages() {
            console.log(this.images)
            this.images.forEach(file => {
                const formData = new FormData();
                formData.append('image', file);

                axios.post('/api/images/upload/', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(res => {
                        alert('Изображения были загружены')
                        this.images =null;
                        console.log(res);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })
        }
    },
    data() {
        return {
            images: []
        }
    }
}
</script>

<template>
    <div class="container">
        <div>
            <div class="row">
                <router-link :to="{name:'result'}">Result</router-link>
            </div>
        </div>

        <div>
            <label for="image-upload" style="font-size: 16px; color: #333; margin-bottom: 10px;">Select Images:</label>
            <input type="file" id="image-upload" multiple @change="selectImages" style="padding: 5px; border: 1px solid #ccc; border-radius: 5px;">
            <button @click="uploadImages" style="background-color: #007bff; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Upload</button>
            <div v-for="image in images" :key="image.name">
                {{ image.name }}
            </div>
        </div>
    </div>

</template>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
</style>
