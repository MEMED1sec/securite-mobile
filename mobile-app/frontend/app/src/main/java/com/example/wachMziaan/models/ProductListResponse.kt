package com.example.wachmziaan.models

data class ProductListResponse(
    val success: Boolean,
    val count: Int,
    val data: List<Product>
)