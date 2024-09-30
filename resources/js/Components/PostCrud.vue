<template>
    <div class="container mt-5">
      <h1 class="text-center mb-5">CRUD Posts</h1>
  
      <!-- Form Section -->
      <div class="card shadow-sm mb-5">
        <div class="card-body">
          <h4 class="mb-4">Add a New Post</h4>
          <form @submit.prevent="addPost">
            <div class="form-group mb-3">
              <label for="title">Title:</label>
              <input v-model="post.title" type="text" class="form-control" id="title" placeholder="Enter title" required />
            </div>
            <div class="form-group mb-3">
              <label for="content">Content:</label>
              <textarea v-model="post.content" class="form-control" id="content" placeholder="Enter content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Add Post</button>
          </form>
        </div>
      </div>
  
      <!-- Posts Section -->
      <h4 class="mb-4">List of Posts</h4>
      <ul class="list-group">
        <li v-for="post in posts" :key="post.id" class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <h5>{{ post.title }}</h5>
            <p>{{ post.content }}</p>
          </div>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" @click="confirmDelete(post.id)">Delete</button>
        </li>
      </ul>
  
      <!-- Delete Confirmation Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Are you sure you want to delete this post?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="deletePost(selectedPostId)">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import 'bootstrap/dist/js/bootstrap.min.js'

export default {
  setup() {
    const posts = ref([]);
    const post = ref({ title: '', content: '' });
    const selectedPostId = ref(null);

    // Fetch all posts
    const getPosts = async () => {
      const response = await axios.get('/posts');
      posts.value = response.data;
    };

    // Add new post
    const addPost = async () => {
      await axios.post('/posts', post.value);
      post.value = { title: '', content: '' }; // Reset form after submit
      getPosts(); // Refresh the list of posts
    };

    // Delete post
    const deletePost = async (id) => {
        await axios.delete(`/posts/${id}`);
        getPosts(); // Refresh the list after deletion
    };

    // Set selected post for deletion
    const confirmDelete = (id) => {
        selectedPostId.value = id;
    };

    getPosts(); // Fetch all posts on mount

    return {
      posts,
      post,
      selectedPostId,
      addPost,
      deletePost,
      confirmDelete,
    };
  },
};
  </script>