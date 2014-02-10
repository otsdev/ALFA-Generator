package com.ots.alfa.fragments;


import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

import com.ots.alfa.R;
import com.ots.alfa.adapters.PostAdapter;

public class PostsFragment extends Fragment {
	private static final String TAG = "PostsFragment";

	ListView lsvPost;

	private PostAdapter mAdapter;
	View layout = null;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		setHasOptionsMenu(true);

	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		layout = (ViewGroup) inflater.inflate(R.layout.fragment_post,
				container, false);

		bindViews(layout);

		return layout;
	}

	public void bindViews(View layout) {
		mAdapter = new PostAdapter(getActivity());
		lsvPost = (ListView) layout.findViewById(R.id.lsv_post);
		lsvPost.setAdapter(mAdapter);

	}

}
