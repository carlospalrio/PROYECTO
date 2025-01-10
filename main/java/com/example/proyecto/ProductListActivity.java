package com.example.proyecto;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.database.Cursor;
import android.os.Bundle;
import android.util.Log;

import java.util.ArrayList;

public class ProductListActivity extends AppCompatActivity {

    private RecyclerView rvProducts;
    private ProductAdapter productAdapter;
    private ArrayList<Product> productList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product_list);

        rvProducts = findViewById(R.id.rvProducts);
        productList = new ArrayList<>();

        DataBaseHelper dbHelper = new DataBaseHelper(this);
        Cursor cursor = dbHelper.getAllProducts();

// Verifica la cantidad de productos en el cursor
        Log.d("ProductListActivity", "Products count: " + cursor.getCount());

        if (cursor != null) {
            while (cursor.moveToNext()) {
                int id = cursor.getInt(0);
                String name = cursor.getString(1);
                String description = cursor.getString(2);
                double price = cursor.getDouble(3);
                int stock = cursor.getInt(4);

                productList.add(new Product(id, name, description, price, stock));
            }
            cursor.close();
        }

        productAdapter = new ProductAdapter(productList);
        rvProducts.setLayoutManager(new LinearLayoutManager(this));
        rvProducts.setAdapter(productAdapter);
    }
}
