<script>
export default {
    name: "Home",
    methods: {
        selectImages(e) {
            const file = e.target.files[0];
            const isDuplicate = this.images.some(image => image.name === file.name);

            if (!isDuplicate) {
                this.images.push(file);
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
