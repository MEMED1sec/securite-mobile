package com.example.fragmentslab

import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.TextView
import androidx.fragment.app.Fragment

class FragmentOne : Fragment(R.layout.fragment_one) {

    private lateinit var tv: TextView
    private lateinit var btnHello: Button

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {
        super.onViewCreated(view, savedInstanceState)

        tv = view.findViewById(R.id.textOne)
        btnHello = view.findViewById(R.id.btnHello)

        btnHello.setOnClickListener {
            tv.text = "Bonjour depuis Fragment 1 !"
        }
    }
}