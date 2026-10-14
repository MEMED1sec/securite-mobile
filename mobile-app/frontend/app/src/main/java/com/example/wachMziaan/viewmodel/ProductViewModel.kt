package com.example.wachmziaan.viewmodel

import androidx.lifecycle.LiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.example.wachmziaan.api.RetrofitClient 
import com.example.wachmziaan.models.Product
import kotlinx.coroutines.Dispatchers
import kotlinx.coroutines.launch
import kotlinx.coroutines.withContext
import retrofit2.HttpException
import java.io.IOException

class ProductViewModel : ViewModel() {
    
    private val _products = MutableLiveData<List<Product>>()
    val products: LiveData<List<Product>> = _products
    
    private val _error = MutableLiveData<String>()
    val error: LiveData<String> = _error
    
    private val _isLoading = MutableLiveData<Boolean>()
    val isLoading: LiveData<Boolean> = _isLoading
    
    fun getProducts() {
        _isLoading.value = true
        
        viewModelScope.launch {
            try {
                val response = withContext(Dispatchers.IO) {
                    RetrofitClient.apiService.getProducts()
                }
                _products.value = response
                _error.value = null
            } catch (e: HttpException) {
                _error.value = "Erreur HTTP: ${e.code()} - ${e.message()}"
            } catch (e: IOException) {
                _error.value = "Erreur réseau: ${e.message}"
            } catch (e: Exception) {
                _error.value = "Erreur inattendue: ${e.message}"
            } finally {
                _isLoading.value = false
            }
        }
    }
    
    fun getProductById(id: Int): LiveData<Product> {
        val result = MutableLiveData<Product>()
        
        viewModelScope.launch {
            try {
                val response = withContext(Dispatchers.IO) {
                    RetrofitClient.apiService.getProductById(id)
                }
                result.value = response
                _error.value = null
            } catch (e: HttpException) {
                _error.value = "Erreur HTTP: ${e.code()} - ${e.message()}"
            } catch (e: IOException) {
                _error.value = "Erreur réseau: ${e.message}"
            } catch (e: Exception) {
                _error.value = "Erreur inattendue: ${e.message}"
            }
        }
        
        return result
    }
}
