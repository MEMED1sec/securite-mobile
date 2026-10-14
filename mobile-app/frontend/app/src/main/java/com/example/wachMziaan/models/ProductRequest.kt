package com.example.wachmziaan.models

data class ProductRequest(
    val barcode: String,
    val name: String,
    val brand: String? = null,
    val ingredients: String? = null,
    val nutriscore: String? = null,
    val additives: String? = null,
    val image_url: String? = null
)
