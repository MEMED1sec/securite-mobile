package com.example.wachmziaan.api

import com.example.wachmziaan.models.Product
import retrofit2.http.*

interface ApiService {
    // Point de terminaison de test
    @GET("test")
    suspend fun testConnection(): String
    
    @GET("products")
    suspend fun getProducts(): List<Product>
    
    @GET("products/{id}")
    suspend fun getProductById(@Path("id") id: Int): Product
    
    @POST("products")
    suspend fun createProduct(@Body product: Product): Product
}
