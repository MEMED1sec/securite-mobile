package com.example.wachmziaan.ui

import android.os.Bundle
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.bumptech.glide.Glide
import com.example.wachmziaan.R
import com.example.wachmziaan.models.Product
import com.example.wachmziaan.models.ProductResponse
import com.example.wachmziaan.network.RetrofitClient
import com.google.android.material.appbar.MaterialToolbar
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class ProductActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_product)

        val toolbar = findViewById<MaterialToolbar>(R.id.toolbar)
        toolbar.setNavigationOnClickListener { finish() }

        val barcode = intent.getStringExtra("barcode")
        if (barcode == null) {
            Toast.makeText(this, "Code-barres manquant", Toast.LENGTH_SHORT).show()
            finish()
            return
        }

        // Appel API
        RetrofitClient.instance.getProduct(barcode).enqueue(object : Callback<ProductResponse> {
            override fun onResponse(
                call: Call<ProductResponse>,
                response: Response<ProductResponse>
            ) {
                if (response.isSuccessful) {
                    val product = response.body()
                    if (product != null) {
                        displayProduct(product.product)
                    } else {
                        showError("Produit non trouvé")
                    }
                } else {
                    showError("Produit non trouvé")
                }
            }

            override fun onFailure(call: Call<ProductResponse>, t: Throwable) {
                showError("Erreur : ${t.message}")
            }
        })
    }

    private fun displayProduct(product: Product?) {
        // Nom du produit
        findViewById<TextView>(R.id.txtName).text = product?.name ?: "Nom inconnu"

        // Marque
        findViewById<TextView>(R.id.txtBrand).text = product?.brand ?: "Marque inconnue"

        // Image du produit avec Glide
        val imgProduct = findViewById<ImageView>(R.id.imgProduct)
        if (!product?.image_url.isNullOrEmpty()) {
            Glide.with(this)
                .load(product.image_url)
                .placeholder(android.R.drawable.ic_menu_gallery)
                .error(android.R.drawable.ic_menu_gallery)
                .into(imgProduct)
        } else {
            imgProduct.setImageResource(android.R.drawable.ic_menu_gallery)
        }

        // Nutriscore
        highlightNutriscore(product?.nutriscore_grade)

        // Ingrédients
        findViewById<TextView>(R.id.txtIngredients).text =
            if (product?.ingredients?.isEmpty() == true) "Informations non disponibles" else product?.ingredients.toString()

        // Additifs
        findViewById<TextView>(R.id.txtAllergens).text =
            if (product?.allergens?.isEmpty() == true) "Aucun additif" else product?.allergens.toString()
    }

    private fun highlightNutriscore(score: String?) {
        val nutrisA = findViewById<TextView>(R.id.txtNutriA)
        val nutrisB = findViewById<TextView>(R.id.txtNutriB)
        val nutrisC = findViewById<TextView>(R.id.txtNutriC)
        val nutrisD = findViewById<TextView>(R.id.txtNutriD)
        val nutrisE = findViewById<TextView>(R.id.txtNutriE)

        // Réinitialiser l'opacité
        listOf(nutrisA, nutrisB, nutrisC, nutrisD, nutrisE).forEach {
            it.alpha = 0.3f
        }

        // Mettre en évidence le bon score
        when (score?.uppercase()) {
            "A" -> nutrisA.alpha = 1.0f
            "B" -> nutrisB.alpha = 1.0f
            "C" -> nutrisC.alpha = 1.0f
            "D" -> nutrisD.alpha = 1.0f
            "E" -> nutrisE.alpha = 1.0f
        }
    }

    private fun showError(message: String) {
        Toast.makeText(this, message, Toast.LENGTH_LONG).show()
        finish()
    }
}