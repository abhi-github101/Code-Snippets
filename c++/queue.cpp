#include<stdio.h>
#include<stdlib.h>

struct node{
	char *item;
	struct node *next;
};

struct node *front=NULL,*back=NULL;
 
struct node *create();
void enqueue(char *c);
char *dequeue();
void print();

int main(){
	while(true){
 		int o=0;
        printf("\nSelect One Option:\n1. Enqueue\n2. Dequeue\n3. Print\nEnter Your Choice: ");
        scanf("%d",&o);
        switch(o){
            case 1://push
                printf("\nENQUEUE ITEM: ");
                char *d=(char *)malloc(sizeof(char));
                scanf("%s",d);
                enqueue(d);
                break;
            case 2://pop
				char *i=dequeue();
				printf("\nItem Dequeued: %s\n",i);
				break;
            case 3://print
              	printf("\nItems: ");
				print();
				break;
            default: 
				printf("\n*********** Bye *************\n");
                exit(0);
                break;    
        }	
	}
	return 0;
}

struct node *create(){
	return (struct node *)malloc(sizeof(struct node));	
}

void enqueue(char *c){
	printf("\nBefore: ");
	print();
	struct node *n;
	n=create();
	n->item=c;
	if(front==NULL&&back==NULL){
		front=n;
		back=n;
		n->next=NULL;
	}else{
		front->next=n;
		front=n;
		n->next=NULL;
	}
	printf("\nAfter: ");
	print();
}

char *dequeue(){
	char *i;
	if(front==NULL&&back==NULL){
		i=(char *)"No Items";
	}else{
		i=back->item;
		back=back->next;
		if(back==NULL){
			front=NULL;
		}		
	}
	return i;
}
	
void print(){
	struct node *temp=back;
	while(temp){
		printf("%s ",temp->item);
		temp=temp->next;
	}
	printf("\n");
}
