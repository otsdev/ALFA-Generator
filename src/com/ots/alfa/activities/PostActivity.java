package com.ots.alfa.activities;

import android.app.Activity;
import android.os.Bundle;
import android.widget.ListView;

import com.ots.alfa.R;
import com.ots.alfa.adapters.PostsAdapter;

public class PostsActivity extends Activity {
	private static final String TAG = "PostsActivity";

	ListView lsvPost;

	private PostsAdapter mAdapter;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_posts);

		bindViews();

	}
        
	private void bindViews() {
		lsvPost = (ListView) findViewById(R.id.lsv_post);

		mAdapter = new PostAdapter(PostsActivity.this);
		lsvPost.setAdapter(mAdapter);
	}

}
