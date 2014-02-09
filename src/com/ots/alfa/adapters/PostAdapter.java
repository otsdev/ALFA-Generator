package com.ots.alfa.adapters;

import java.util.ArrayList;
import java.util.List;
import com.ots.alfa.R;
import com.ots.alfa.models.PostModel;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;


public class PostAdapter extends BaseAdapter {

	private Context mContext;
	private List<PostModel> mPostModel;
	private LayoutInflater mInflator;

	public PostAdapter(Context context) {
		this(context, null);
	}

	public PostAdapter(Context context, ArrayList<PostModel> postModel) {

		this.mPostModel = postModel;
		this.mContext = context;
		mInflator = LayoutInflater.from(context);

	}

	@Override
	public int getCount() {
		if (null == mPostModel) {
			return 0;
		}

		return mPostModel.size();
	}

	@Override
	public Object getItem(int position) {
		return mPostModel.get(position);
	}

	@Override
	public long getItemId(int position) {
		return position;
	}

	@Override
	public View getView(int position, View convertView, ViewGroup parent) {
		ViewHolder viewHolder;

		if (null == convertView) {
			convertView = mInflator.inflate(R.layout.list_item_post, parent,
					false);
			viewHolder = new ViewHolder(convertView);

			convertView.setTag(viewHolder);
			convertView.setClickable(true);

		} else {
			viewHolder = (ViewHolder) convertView.getTag();
		}

		PostModel postModel = (PostModel) getItem(position);
		viewHolder.postModel = postModel;

		return convertView;
	}

	public void addPostModel(List<PostModel> postModel) {
		if (null == postModel || postModel.size() < 1) {
			return;
		}

		if (null == mPostModel) {
			mPostModel = postModel;
		} else {
			mPostModel.addAll(postModel);
		}

		notifyDataSetChanged();
	}

	static class ViewHolder {
		PostModel postModel;

		public ViewHolder(View v) {

		}
	}
}