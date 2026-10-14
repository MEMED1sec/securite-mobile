package com.example.wachmziaan.models

data class Product(
    val id: Int? = null,
    val barcode: String,
    val name: String?,
    val brand: String? = null,
    val ingredients: List<String> = emptyList(),
    val nutriscore_grade: String? = null,
    val image_url: String? = null,
    val serving_size: String? = null,
    val allergens: List<String> = emptyList(),
    val additives: List<Additive> = emptyList()
)
