package com.example.fragmentslab

import android.os.Bundle
import android.widget.Button
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment

class MainActivity : AppCompatActivity() {

    private lateinit var btn1: Button
    private lateinit var btn2: Button

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        btn1 = findViewById(R.id.btnFragment1)
        btn2 = findViewById(R.id.btnFragment2)

        if (savedInstanceState == null) {
            replaceFragment(FragmentOne(), false)
        }

        btn1.setOnClickListener {
            replaceFragment(FragmentOne(), true)
        }

        btn2.setOnClickListener {
            replaceFragment(FragmentTwo(), true)
        }
    }

    private fun replaceFragment(fragment: Fragment, addToBackStack: Boolean) {
        val ft = supportFragmentManager.beginTransaction()
            .setReorderingAllowed(true)
            .replace(R.id.fragment_container, fragment)

        if (addToBackStack) {
            ft.addToBackStack(null)
        }

        ft.commit()
    }
}